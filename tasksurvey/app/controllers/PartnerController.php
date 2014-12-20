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
            $query = Criteria::fromInput($this->di, "Partner", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "partner_id";

        $partner = Partner::find($parameters);
        if (count($partner) == 0) {
            $this->flash->notice("The search did not find any partner");

            return $this->dispatcher->forward(array(
                "controller" => "partner",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $partner,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a partner
     *
     * @param string $partner_id
     */
    public function editAction($partner_id)
    {

        if (!$this->request->isPost()) {

            $partner = Partner::findFirstBypartner_id($partner_id);
            if (!$partner) {
                $this->flash->error("partner was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "partner",
                    "action" => "index"
                ));
            }

            $this->view->partner_id = $partner->partner_id;

            $this->tag->setDefault("partner_id", $partner->partner_id);
            $this->tag->setDefault("name", $partner->name);
            
        }
    }

    /**
     * Creates a new partner
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "partner",
                "action" => "index"
            ));
        }

        $partner = new Partner();

        $partner->name = $this->request->getPost("name");
        

        if (!$partner->save()) {
            foreach ($partner->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "partner",
                "action" => "new"
            ));
        }

        $this->flash->success("partner was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "partner",
            "action" => "index"
        ));

    }

    /**
     * Saves a partner edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "partner",
                "action" => "index"
            ));
        }

        $partner_id = $this->request->getPost("partner_id");

        $partner = Partner::findFirstBypartner_id($partner_id);
        if (!$partner) {
            $this->flash->error("partner does not exist " . $partner_id);

            return $this->dispatcher->forward(array(
                "controller" => "partner",
                "action" => "index"
            ));
        }

        $partner->name = $this->request->getPost("name");
        

        if (!$partner->save()) {

            foreach ($partner->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "partner",
                "action" => "edit",
                "params" => array($partner->partner_id)
            ));
        }

        $this->flash->success("partner was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "partner",
            "action" => "index"
        ));

    }

    /**
     * Deletes a partner
     *
     * @param string $partner_id
     */
    public function deleteAction($partner_id)
    {

        $partner = Partner::findFirstBypartner_id($partner_id);
        if (!$partner) {
            $this->flash->error("partner was not found");

            return $this->dispatcher->forward(array(
                "controller" => "partner",
                "action" => "index"
            ));
        }

        if (!$partner->delete()) {

            foreach ($partner->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "partner",
                "action" => "search"
            ));
        }

        $this->flash->success("partner was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "partner",
            "action" => "index"
        ));
    }

}
