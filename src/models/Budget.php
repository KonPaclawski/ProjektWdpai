<?php

class Budget{

    private $title;
    private $budget;
    private $categories;
    public function __construct($title, $budget, $categories)
    {
        $this->title = $title;
        $this->budget = $budget;
        $this->categories = $categories;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getBudget()
    {
        return $this->budget;
    }

    public function setBudget($budget): void
    {
        $this->budget = $budget;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getRemainingBudget(){
        $x = 0;
        foreach($this->categories as $payments){
            foreach ($payments as $payment){
                $x = $x + $payment["to_pay"];
            }
        }
        return $x;
    }

}