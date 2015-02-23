<?php
namespace App\Vacancy\Controller;
use \Base\Controller;

class Index extends Controller
{
    public function indexAction()
    {
        $this->assign('repository', $this->app->getRepository('Vacancy')->all());
        $this->assign('languages', $this->app->getRepository('VacancyLanguage')->all());
        $this->assign('departments', $this->app->getRepository('Department')->all());
    }

    public function filterAction()
    {
        $department = isset($_POST['department']) ? $_POST['department'] : 0;
        $language = isset($_POST['language']) ? $_POST['language'] : 0;
        return $this->ajax(['vacancies' => $this->app->getRepository('Vacancy')->getFilter($department, $language, true)]);
    }
}
