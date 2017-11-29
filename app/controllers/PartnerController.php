<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class PartnerController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for partner
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Partner', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $partner = Partner::find($parameters);
        if (count($partner) == 0) {
            $this->flash->notice("The search did not find any partner");

            $this->dispatcher->forward([
                "controller" => "partner",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $partner,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a partner
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $partner = Partner::findFirstByid($id);
            if (!$partner) {
                $this->flash->error("partner was not found");

                $this->dispatcher->forward([
                    'controller' => "partner",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $partner->id;

            $this->tag->setDefault("id", $partner->id);
            $this->tag->setDefault("name", $partner->name);
            $this->tag->setDefault("description", $partner->description);
            $this->tag->setDefault("NIP", $partner->NIP);
            $this->tag->setDefault("webiste", $partner->webiste);
            $this->tag->setDefault("DATE", $partner->DATE);
            
        }
    }

    /**
     * Creates a new partner
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "partner",
                'action' => 'index'
            ]);

            return;
        }

        $partner = new Partner();
        $partner->name = $this->request->getPost("name");
        $partner->description = $this->request->getPost("description");
        $partner->nIP = $this->request->getPost("NIP");
        $partner->webiste = $this->request->getPost("webiste");
        $partner->dATE = $this->request->getPost("DATE");
        

        if (!$partner->save()) {
            foreach ($partner->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "partner",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("partner was created successfully");

        $this->dispatcher->forward([
            'controller' => "partner",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a partner edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "partner",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $partner = Partner::findFirstByid($id);

        if (!$partner) {
            $this->flash->error("partner does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "partner",
                'action' => 'index'
            ]);

            return;
        }

        $partner->name = $this->request->getPost("name");
        $partner->description = $this->request->getPost("description");
        $partner->nIP = $this->request->getPost("NIP");
        $partner->webiste = $this->request->getPost("webiste");
        $partner->dATE = $this->request->getPost("DATE");
        

        if (!$partner->save()) {

            foreach ($partner->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "partner",
                'action' => 'edit',
                'params' => [$partner->id]
            ]);

            return;
        }

        $this->flash->success("partner was updated successfully");

        $this->dispatcher->forward([
            'controller' => "partner",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a partner
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $partner = Partner::findFirstByid($id);
        if (!$partner) {
            $this->flash->error("partner was not found");

            $this->dispatcher->forward([
                'controller' => "partner",
                'action' => 'index'
            ]);

            return;
        }

        if (!$partner->delete()) {

            foreach ($partner->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "partner",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("partner was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "partner",
            'action' => "index"
        ]);
    }

}
