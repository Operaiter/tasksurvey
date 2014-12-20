<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PartnerUnitController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for partner_unit
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "PartnerUnit", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "unit_id";

        $partner_unit = PartnerUnit::find($parameters);
        if (count($partner_unit) == 0) {
            $this->flash->notice("The search did not find any partner_unit");

            return $this->dispatcher->forward(array(
                "controller" => "partner_unit",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $partner_unit,
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
     * Edits a partner_unit
     *
     * @param string $unit_id
     */
    public function editAction($unit_id)
    {

        if (!$this->request->isPost()) {

            $partner_unit = PartnerUnit::findFirstByunit_id($unit_id);
            if (!$partner_unit) {
                $this->flash->error("partner_unit was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "partner_unit",
                    "action" => "index"
                ));
            }

            $this->view->unit_id = $partner_unit->unit_id;

            $this->tag->setDefault("unit_id", $partner_unit->unit_id);
            $this->tag->setDefault("partner_id", $partner_unit->partner_id);
            $this->tag->setDefault("name", $partner_unit->name);
            
        }
    }

    /**
     * Creates a new partner_unit
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "partner_unit",
                "action" => "index"
            ));
        }

        $partner_unit = new PartnerUnit();

        $partner_unit->partner_id = $this->request->getPost("partner_id");
        $partner_unit->name = $this->request->getPost("name");
        

        if (!$partner_unit->save()) {
            foreach ($partner_unit->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "partner_unit",
                "action" => "new"
            ));
        }

        $this->flash->success("partner_unit was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "partner_unit",
            "action" => "index"
        ));

    }

    /**
     * Saves a partner_unit edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "partner_unit",
                "action" => "index"
            ));
        }

        $unit_id = $this->request->getPost("unit_id");

        $partner_unit = PartnerUnit::findFirstByunit_id($unit_id);
        if (!$partner_unit) {
            $this->flash->error("partner_unit does not exist " . $unit_id);

            return $this->dispatcher->forward(array(
                "controller" => "partner_unit",
                "action" => "index"
            ));
        }

        $partner_unit->partner_id = $this->request->getPost("partner_id");
        $partner_unit->name = $this->request->getPost("name");
        

        if (!$partner_unit->save()) {

            foreach ($partner_unit->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "partner_unit",
                "action" => "edit",
                "params" => array($partner_unit->unit_id)
            ));
        }

        $this->flash->success("partner_unit was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "partner_unit",
            "action" => "index"
        ));

    }

    /**
     * Deletes a partner_unit
     *
     * @param string $unit_id
     */
    public function deleteAction($unit_id)
    {

        $partner_unit = PartnerUnit::findFirstByunit_id($unit_id);
        if (!$partner_unit) {
            $this->flash->error("partner_unit was not found");

            return $this->dispatcher->forward(array(
                "controller" => "partner_unit",
                "action" => "index"
            ));
        }

        if (!$partner_unit->delete()) {

            foreach ($partner_unit->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "partner_unit",
                "action" => "search"
            ));
        }

        $this->flash->success("partner_unit was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "partner_unit",
            "action" => "index"
        ));
    }

}
