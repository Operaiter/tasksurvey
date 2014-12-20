<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class SkillsController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for skills
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Skills", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "skills_id";

        $skills = Skills::find($parameters);
        if (count($skills) == 0) {
            $this->flash->notice("The search did not find any skills");

            return $this->dispatcher->forward(array(
                "controller" => "skills",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $skills,
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
     * Edits a skill
     *
     * @param string $skills_id
     */
    public function editAction($skills_id)
    {

        if (!$this->request->isPost()) {

            $skill = Skills::findFirstByskills_id($skills_id);
            if (!$skill) {
                $this->flash->error("skill was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "skills",
                    "action" => "index"
                ));
            }

            $this->view->skills_id = $skill->skills_id;

            $this->tag->setDefault("skills_id", $skill->skills_id);
            $this->tag->setDefault("partner_id", $skill->partner_id);
            $this->tag->setDefault("name", $skill->name);
            $this->tag->setDefault("name_short", $skill->name_short);
            $this->tag->setDefault("description", $skill->description);
            
        }
    }

    /**
     * Creates a new skill
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "skills",
                "action" => "index"
            ));
        }

        $skill = new Skills();

        $skill->partner_id = $this->request->getPost("partner_id");
        $skill->name = $this->request->getPost("name");
        $skill->name_short = $this->request->getPost("name_short");
        $skill->description = $this->request->getPost("description");
        

        if (!$skill->save()) {
            foreach ($skill->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "skills",
                "action" => "new"
            ));
        }

        $this->flash->success("skill was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "skills",
            "action" => "index"
        ));

    }

    /**
     * Saves a skill edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "skills",
                "action" => "index"
            ));
        }

        $skills_id = $this->request->getPost("skills_id");

        $skill = Skills::findFirstByskills_id($skills_id);
        if (!$skill) {
            $this->flash->error("skill does not exist " . $skills_id);

            return $this->dispatcher->forward(array(
                "controller" => "skills",
                "action" => "index"
            ));
        }

        $skill->partner_id = $this->request->getPost("partner_id");
        $skill->name = $this->request->getPost("name");
        $skill->name_short = $this->request->getPost("name_short");
        $skill->description = $this->request->getPost("description");
        

        if (!$skill->save()) {

            foreach ($skill->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "skills",
                "action" => "edit",
                "params" => array($skill->skills_id)
            ));
        }

        $this->flash->success("skill was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "skills",
            "action" => "index"
        ));

    }

    /**
     * Deletes a skill
     *
     * @param string $skills_id
     */
    public function deleteAction($skills_id)
    {

        $skill = Skills::findFirstByskills_id($skills_id);
        if (!$skill) {
            $this->flash->error("skill was not found");

            return $this->dispatcher->forward(array(
                "controller" => "skills",
                "action" => "index"
            ));
        }

        if (!$skill->delete()) {

            foreach ($skill->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "skills",
                "action" => "search"
            ));
        }

        $this->flash->success("skill was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "skills",
            "action" => "index"
        ));
    }

}
