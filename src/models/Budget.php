<?php

class Budget{
    private $title;
    private $budget;
    private $categories;
    private $titles;
    private $amount;
    private $dates;
    public function __construct($title, $budget, $categories, $titles, $amount, $dates)
    {
        $this->title = $title;
        $this->budget = $budget;
        $this->categories = $categories;
        $this->titles = $titles;
        $this->ammount = $amount;
        $this->dates = $dates;
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

    public function setCategories($categories): void
    {
        $this->categories = $categories;
    }

    public function getTitles()
    {
        return $this->titles;
    }

    public function setTitles($titles): void
    {
        $this->titles = $titles;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    public function getDates()
    {
        return $this->dates;
    }

    public function setDates($dates): void
    {
        $this->dates = $dates;
    }


}