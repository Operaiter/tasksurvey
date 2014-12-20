<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class MissionController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for mission
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Mission", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "mission_id";

        $mission = Mission::find($parameters);
        if (count($mission) == 0) {
            $this->flash->notice("The search did not find any mission");

            return $this->dispatcher->forward(array(
                "controller" => "mission",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $mission,
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
     * Edits a mission
     *
     * @param string $mission_id
     */
    public function editAction($mission_id)
    {

        if (!$this->request->isPost()) {

            $mission = Mission::findFirstBymission_id($mission_id);
            if (!$mission) {
                $this->flash->error("mission was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "mission",
                    "action" => "index"
                ));
            }

            $this->view->mission_id = $mission->mission_id;

            $this->tag->setDefault("mission_id", $mission->mission_id);
            $this->tag->setDefault("time", $mission->time);
            $this->tag->setDefault("active", $mission->active);
            $this->tag->setDefault("time_change", $mission->time_change);
            
        }
    }

    /**
     * Creates a new mission
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "mission",
                "action" => "index"
            ));
        }

        $mission = new Mission();

        $mission->time = $this->request->getPost("time");
        $mission->active = $this->request->getPost("active");
        $mission->time_change = $this->request->getPost("time_change");
        

        if (!$mission->save()) {
            foreach ($mission->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "mission",
                "action" => "new"
            ));
        }

        $this->flash->success("mission was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "mission",
            "action" => "index"
        ));

    }

    /**
     * Saves a mission edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "mission",
                "action" => "index"
            ));
        }

        $mission_id = $this->request->getPost("mission_id");

        $mission = Mission::findFirstBymission_id($mission_id);
        if (!$mission) {
            $this->flash->error("mission does not exist " . $mission_id);

            return $this->dispatcher->forward(array(
                "controller" => "mission",
                "action" => "index"
            ));
        }

        $mission->time = $this->request->getPost("time");
        $mission->active = $this->request->getPost("active");
        $mission->time_change = $this->request->getPost("time_change");
        

        if (!$mission->save()) {

            foreach ($mission->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "mission",
                "action" => "edit",
                "params" => array($mission->mission_id)
            ));
        }

        $this->flash->success("mission was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "mission",
            "action" => "index"
        ));

    }

    /**
     * Deletes a mission
     *
     * @param string $mission_id
     */
    public function deleteAction($mission_id)
    {

        $mission = Mission::findFirstBymission_id($mission_id);
        if (!$mission) {
            $this->flash->error("mission was not found");

            return $this->dispatcher->forward(array(
                "controller" => "mission",
                "action" => "index"
            ));
        }

        if (!$mission->delete()) {

            foreach ($mission->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "mission",
                "action" => "search"
            ));
        }

        $this->flash->success("mission was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "mission",
            "action" => "index"
        ));
    }

}
