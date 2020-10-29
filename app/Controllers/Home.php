<?php namespace App\Controllers;

class Home extends BaseController
{
	public function __construct(){
        parent::__construct();
    }
    
	public function index()
	{
		return view('index/index', $this->data);
	}

	public function about()
	{
		$cmsModel = new \App\Models\Cms();
        
        $this->data['whyUsContent'] = $cmsModel->where('title', 'why-us')->first();
        $this->data['ourApproach'] = $cmsModel->where('title', 'our-approach')->first();
        $this->data['ourStory'] = $cmsModel->where('title', 'our-story')->first();		
        return view('index/about', $this->data);
	}

	public function faqs(){
		$faqsModel = new \App\Models\Faq();
		$this->data['faqs'] = $faqsModel->where('is_show', '1')->find();
		return view('index/faqs', $this->data);
	}
}
