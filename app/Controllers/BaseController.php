<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url', 'my'];

	var $data = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
	}

	function __construct(){

    	$settingModel = new \App\Models\Setting();   
    	$cmsModel = new \App\Models\Cms();
    	$serviceModel = new \App\Models\Service();

    	$allSettings = $settingModel->where('status', '1')->findAll();
        $allServices = $serviceModel->where('status', '1')->findAll();

    	foreach($allSettings as $as){
			$this->data['settings'][$as->title] = $as->value;
		}
		
		$this->data['allServices'] = $allServices;
		$this->data['aboutUsContent'] = $cmsModel->where('title', 'about-us')->first();
		// $this->sendEmail(['to' => 'naveed.ramzan@gmail.com',
		// 				  'subject' => 'Subject from M.O.M.',
		// 				  'body' => 'Test Email from M.O.M.Test Email from M.O.M.Test Email from M.O.M.Test Email from M.O.M.Test Email from M.O.M.Test Email from M.O.M.Test Email from M.O.M.Test Email from M.O.M.Test Email from M.O.M.Test Email from M.O.M.Test Email from M.O.M.',
		// 				]);
    }

	public function insertRecord($table, $dbData){
		$db = \Config\Database::connect();
    	$builder = $db->table($table);    	
		$builder->insert($dbData);
		return $db->insertID();
	}

	public function updateRecord($table, $dbData, $recordId){
		$db = \Config\Database::connect();

    	$builder = $db->table($table); 
    	$builder->set($dbData);
    	$builder->where('id', $recordId); 

		if($builder->update()){
			return true;
		}else{
			return false;
		}
	}

	public function sendEmail($mailData){

		$settingModel = new \App\Models\Setting();
		$emailTemplateModel = new \App\Models\Emailtemplate();
		$emailTemplate = $emailTemplateModel->where('id', $mailData['templateId'])->first();
		$signatureRecord = $settingModel->where('id', '1')->first();
		$siteNameRecord = $settingModel->where('id', '2')->first();
		$emailBody = $emailTemplate->content;
		if($mailData['firstName']){
			$emailBody = str_replace('{name}', '<span style="color:#cc0000;">'.$mailData['firstName'].'</span>', $emailBody);
		}
		if($mailData['password']){
			$emailBody = str_replace('{password}', '<span style="color:#cc0000;">'.$mailData['password'].'</span>', $emailBody);
		}
		if($mailData['email']){
			$emailBody = str_replace('{email}', '<span style="color:#cc0000;">'.$mailData['email'].'</span>', $emailBody);
		}

		if($mailData['planSummary']){
			$emailBody = str_replace('{planSummary}', $mailData['planSummary'], $emailBody);
		}
		if($mailData['billingInfo']){
			$emailBody = str_replace('{billingInfo}', $mailData['billingInfo'], $emailBody);
		}
		$emailBody = str_replace('{siteName}', '<span><a style="color:#cc0000;" href="'.base_url().'">'.$siteNameRecord->value.'</a></span>', $emailBody);
		$subject = $mailData['subject'];
		if($mailData['campaignId']){
			$campaignModel = new \App\Models\Campaign();
			$campaignRecord = $campaignModel->where('id', $mailData['campaignId'])->first();
			$emailBody = str_replace('{campaignName}', '<span style="color:#cc0000;">'.$campaignRecord->title.'</span>', $emailBody);
			$subject = $campaignRecord->title;
		}
		$emailBody = str_replace('{signature}', '', $emailBody);
		// debug($emailBody);
		if(!$mailData['templateId']){
			$emailBody = $mailData['body'].'<br>';
			foreach($mailData as $key => $val){
				$emailBody .= $key .' - ' . $val.'<br>';
			}
		}
		
		$email = \Config\Services::email();
		$config = ['protocol' => 'mail',
				   'smtp_host' => 'mail.hellomealsonme.com',
				   'smtp_port' => 587,
				   'smtp_user' => 'digital@hellomealsonme.com',
				   'smtp_pass' => 'Digital@MOM',
				   'mailtype'  => 'html', 
				   'charset'   => 'utf-8',
				   'validation' => false,
				   'newline' => "\r\n",
				];
		$email->initialize($config);
		// $email->setFrom(EMAIL_FROM, EMAIL_NAME);
		$email->setTo($mailData['to']);
		if(array_key_exists('cc', $mailData)){
			$email->setCC($mailData['cc']);
		}
		if(array_key_exists('bcc', $mailData)){
			$email->setBCC($mailData['bcc']);
		}
		
		$email->setSubject($subject);

		$emailBody = '<table width="60%">
						<tr><td><img src="'.assetUrl().'images/email-header.jpg"></td></tr>
						<tr>
							<td style="padding:20px 100px; font-size:15px; line-height:40px;">
								'.$emailBody.'
							</td>
						</tr>
						<tr><td><img src="'.assetUrl().'images/email-footer.jpg"></td></tr>
					  </table>';

		$email->setMessage($emailBody);
		// echo $emailBody;exit;
		if($email->send()){
			return true;
		}else{
			debug($email->printDebugger());
			return false;
		}
	}

	public function showlistAdmin($table)
	{
		$session = \Config\Services::session();

		if($session->adminData === NULL){
			return redirect('admin-logout');
		}

		$request = \Config\Services::request();
		$pager = \Config\Services::pager();
		$page = ($request->getVar('page'))?(int)$request->getVar('page'):1;
		$perPage  = (int)$this->data['settings']['adminNoOfRecords'];
		
		$db = \Config\Database::connect();
		$queryBuilder = $db->table($table);

		$where[] = ['status' => '1'];
		if($request->getVar('action') == 'search'){
			$where[] = ['title like' => '%'.$request->getVar('title').'%'];
		}
		
		$schemaRs 					= $db->getFieldData($table);
		$schema 					= array();
		$searchField = 'code';
		foreach($schemaRs as $s){
			$schema[] = ['name' => $s->name,
						 'null' => $s->nullable,
						];
			if($s->name == 'title'){
				$searchField = 'title';
			}
		}

		$totalRecords = $queryBuilder->where($where)->countAll();

		$offset = ($page > 1)?($page-1)*$perPage:0;
		
		$queryDb = $queryBuilder->where(['status' => 1])
								->like($searchField, ($request->getVar('title') != null)?$request->getVar('title'):'')
								->orderBy('created_at', 'desc')
								->limit($perPage, $offset)
								->get();
		$pager->makeLinks($page, $perPage, $totalRecords);

		$this->data['results'] = $queryDb->getResult();
		$this->data['pager'] = $pager;
		$this->data['table'] = ucwords($table);
		$this->data['schema'] = $schema;
		
		return view('admin/common/list', $this->data);
	}

	public function addRecordAdmin($table){
		$session = \Config\Services::session();

		if($session->adminData === NULL){
			return redirect('admin-logout');
		}

		$db = \Config\Database::connect();
		$queryBuilder = $db->table($table);
		$schemaRs 					= $db->getFieldData($table);
		
		foreach($schemaRs as $s){
			$this->data['schema'][] = ['name' => $s->name,
									   'type' => $s->type,
									   'null' => $s->nullable,
									];
		}
		$this->data['table'] = $table;

    	return view('admin/common/add', $this->data);
    }

    public function addRecordAdminSave($table){
    	$session = \Config\Services::session();
    	$request = \Config\Services::request();
		if($session->adminData === NULL){
			return redirect('admin-logout');
		}

		foreach($request->getVar() as $key => $val){
			$dbData[$key] = $val;
		}

		$db = \Config\Database::connect();
		$queryBuilder = $db->table($table);
		$queryBuilder->where($dbData)
					 ->get();
		if($queryBuilder->num_rows == null){

			$dbData['created_by'] = $session->adminData->id;
			$dbData['status'] = 1;

			if($recordId = $this->insertRecord($table, $dbData)){
				$session->setFlashdata('success', 'Record Saved !');
			}else{
				$session->setFlashdata('error', 'Record already exists !');
			}			
		}

		return redirect()->to(base_url('/admin-showlist/'.$table)); 
    }

    public function deleteRecordPermanent($table, $recId){
    	$session = \Config\Services::session();
    	if($session->adminData === NULL){
			return redirect('admin-logout');
		}
		$db = \Config\Database::connect();
		$queryBuilder = $db->table($table);
		$queryBuilder->where(['id' => $recId])
					 ->delete();
		return redirect()->to(base_url('/admin-showlist/'.$table));
    }

    public function updateRecordAdminSave($table, $recId){
    	$session = \Config\Services::session();
    	$request = \Config\Services::request();
		if($session->adminData === NULL){
			return redirect('admin-logout');
		}

		foreach($request->getVar() as $key => $val){
			if($table == 'settings'){
				$dbData[$key] = strip_tags($val);	
			}else{
				$dbData[$key] = $val;
			}
			
		}

		$db = \Config\Database::connect();
		$queryBuilder = $db->table($table);
		$queryBuilder->where($dbData)
					 ->get();

		// if($queryBuilder->num_rows == ''){
			$dbData['updated_by'] = $session->adminData->id;

			if($this->updateRecord($table, $dbData, $recId)){
				$session->setFlashdata('success', 'Record Updated !');
			}else{
				$session->setFlashdata('error', 'Record already exists !');
			}		
		// }else{
		// 	$session->setFlashdata('error', 'Record already exists !');
		// }
		return redirect()->to(base_url('/admin-showlist/'.$table));
    }

    public function updateRecordAdmin($table, $recId){
		$session = \Config\Services::session();
		if($session->adminData === NULL){
			return redirect('admin-logout');
		}

		$db = \Config\Database::connect();
		$queryBuilder = $db->table($table);
		$schemaRs 	  = $db->getFieldData($table);
		
		foreach($schemaRs as $s){
			$this->data['schema'][] = ['name' => $s->name,
									   'type' => $s->type,
									   'null' => $s->nullable,
									];
		}
		
		$this->data['table'] = $table;
		$this->data['recId'] = $recId;		
    	return view('admin/common/update', $this->data);
    }

}
