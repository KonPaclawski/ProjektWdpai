<?php

class Budget{

    private $title;
    private $budget;
    private $category;
    public function __construct($title, $budget, $category)
    {
        $this->title = $title;
        $this->budget = $budget;
        $this->category = $category;
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
        return $this->category;
    }
    public function setCategories($categories)
    {
        $this->category = $categories;
    }
    public function getRemainingBudget(){
        $x = 0;
        foreach($this->category as $payments){
            foreach ($payments as $payment){
                $x = $x + $payment["to_pay"];
            }
        }
        return $x;
    }

}