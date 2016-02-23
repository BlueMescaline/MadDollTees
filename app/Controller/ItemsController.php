<?php
App::uses('AppController', 'Controller','File','Utility');
/**
 * Items Controller
 *
 * @property Item $Item
 * @property PaginatorComponent $Paginator
 */
class ItemsController extends AppController {


/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
        if($this->Auth->user('user_type')==1) $this->view='admin_index';
		$this->Item->recursive = 0;
		$this->set('items', $this->Paginator->paginate());
	}

    /**
     * search method
     * search in item names by letter or keyword
     *
     */
    //Search is working, but ORDERING doesn`t.
    //Ha Név/ár szerint akarom a keresést rendezni akkor az items/search lapot akarja, nem az items/index-et
    public function search() {
        if(!empty($this->data)) {
            $search=$this->data['Item']['name'];
        //    $data = $this->Item->find('all',array('order'=>'name','conditions'=>array('name LIKE'=>'%'.$search.'%')));
            $this->Item->recursive = 0;
            $data = $this->Paginator->paginate('Item', array('name LIKE' => '%'.$search.'%'));

            $this->set('items',$data);
            $this->render('index');
        }
    }

    /**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        if($this->Auth->user('user_type')==1) $this->view='admin_view';
        if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		$options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
		$this->set('item', $this->Item->find('first', $options));
        //Shirt sizes
        $sizes=array('s'=>'S',
                    'm'=>'M',
                    'l'=>'L',
                    'xl'=>'XL',
                    'xxl'=>'XXL');
        $this->set('sizes',$sizes);
	}

/**
 * add method
 * only for users with admin premission. Creates and saves a new Item in the database.
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Item->create();
            $this->request->data['Item']['image'] = $this->admin_imageUpload();
			if ($this->Item->save($this->request->data) ) {
				$this->Session->setFlash(__('The item has been saved.'));
				return $this->redirect(array('action' => 'index', 'admin'=>false));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		}
	}

 /**
  * File upload method
  * Gets the file's base name, and add timestamp to it, to be unique and move file to the default IMAGES folder
  * If there is no file to upload, nothing happen.
  * @return void
  */
    public function admin_imageUpload(){
        $filename='';
        $uploadData = $this->request->data['Item']['image'];
        if ( $uploadData['size'] == 0 || $uploadData['error'] !== 0){
            return "";
        }
        $filename = basename($uploadData['name']); // gets the base name of the uploaded file
        $uploadFolder = IMAGES;  // path where the uploaded file has to be saved
        $filename = time() .'_'. $filename; // adding time stamp for the uploaded image for uniqueness
        $uploadPath =  $uploadFolder . DS . $filename;
        if( !file_exists($uploadFolder) ){
            mkdir($uploadFolder); // creates folder if  not found
        }
        if (!move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
            return false;
        }
        return $filename;
        $this->set('image',$filename);
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Item']['image'] = $this->admin_imageUpload();

            if (empty($this->request->data['Item']['image'])){
                $item= $this->Item->findById($id);
                $kep=$item['Item']['image'];
                $this->request->data['Item']['image']=$kep;
            }
            if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__('The item has been saved.'));
				return $this->redirect(array('action' => 'index', 'admin' => false));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
			$this->request->data = $this->Item->find('first', $options);
            $this->set('pic',$this->request->data['Item']['image']);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Item->id = $id;
        $data=$this->Item->findById($id);
		if (!$id || !$this->Item->exists()) {
			throw new NotFoundException(__('ID was not set.'));
		}
        if($this->request->is('post')) {
            $this->request->allowMethod('post', 'delete');
            $filename=$data['Item']['image'];
            $file= new File(IMAGES.DS.$filename);
		    if ($this->Item->delete() && $file->delete()) {
			    $this->Session->setFlash(__('The item has been deleted.'));
		    } else {
			$this->Session->setFlash(__('The item could not be deleted. Please, try again.'));
            }
        }
		return $this->redirect(array('action' => 'index', 'admin'=>false));
	}

    public function beforeFilter() {
        parent::beforeFilter();
    }
}
Router::connect('/about', array('controller' => 'pages', 'action' => 'display', 'about'));
Router::connect('/about', array('controller' => 'pages', 'action' => 'display', 'about'));