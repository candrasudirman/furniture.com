<?php
class ControllerModuleProductTab extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/product_tab');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('extension/module');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('product_tab', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
						
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_edit'] = $this->language->get('text_edit');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_tab'] = $this->language->get('entry_tab');
		$data['entry_latest'] = $this->language->get('entry_latest');
		$data['entry_featured'] = $this->language->get('entry_featured');
		$data['entry_bestseller'] = $this->language->get('entry_bestseller');
		$data['entry_special'] = $this->language->get('entry_special');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}
		
		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}
		
		if (isset($this->error['image'])) {
			$data['error_image'] = $this->error['image'];
		} else {
			$data['error_image'] = array();
		}
	       
        // store config data
        
        //$config_data = array(
//
//        'latest_products_status',
//		'featured_products_status',
//		'bestseller_products_status',
//		'special_products_status',
//        );
//        
//        foreach ($config_data as $conf) {
//            if (isset($this->request->post[$conf])) {
//                $data[$conf] = $this->request->post[$conf];
//            } else {
//                $data[$conf] = $this->config->get($conf);
//            }
//        }
		 
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/product_tab', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/product_tab', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/product_tab', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		$data['token'] = $this->session->data['token'];
		
		$data['modules'] = array();
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['featured_products_status'])) {
			$data['featured_products_status'] = $this->request->post['featured_products_status'];
		} elseif (!empty($module_info)) {
			$data['featured_products_status'] = $module_info['featured_products_status'];
		} else {
			$data['featured_products_status'] = '';
		}
		
		if (isset($this->request->post['latest_products_status'])) {
			$data['latest_products_status'] = $this->request->post['latest_products_status'];
		} elseif (!empty($module_info)) {
			$data['latest_products_status'] = $module_info['latest_products_status'];
		} else {
			$data['latest_products_status'] = '';
		}
		
		if (isset($this->request->post['bestseller_products_status'])) {
			$data['bestseller_products_status'] = $this->request->post['bestseller_products_status'];
		} elseif (!empty($module_info)) {
			$data['bestseller_products_status'] = $module_info['bestseller_products_status'];
		} else {
			$data['bestseller_products_status'] = '';
		}
		
		if (isset($this->request->post['special_products_status'])) {
			$data['special_products_status'] = $this->request->post['special_products_status'];
		} elseif (!empty($module_info)) {
			$data['special_products_status'] = $module_info['special_products_status'];
		} else {
			$data['special_products_status'] = '';
		}
				
		//$this->load->model('design/layout');
		
		//$data['layouts'] = $this->model_design_layout->getLayouts();
		
		if (isset($this->request->post['limit'])) {
			$data['limit'] = $this->request->post['limit'];
		} elseif (!empty($module_info)) {
			$data['limit'] = $module_info['limit'];
		} else {
			$data['limit'] = 5;
		}
		
		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = 200;
		}	
			
		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = 200;
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/product_tab.tpl', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/product_tab')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if (!$this->request->post['width']) {
			$this->error['width'] = $this->language->get('error_width');
		}
		
		if (!$this->request->post['height']) {
			$this->error['height'] = $this->language->get('error_height');
		}
		
		return !$this->error;
	
	}
}