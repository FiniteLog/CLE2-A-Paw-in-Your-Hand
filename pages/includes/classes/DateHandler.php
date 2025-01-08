<?php

class DateHandler
{
    private $currentDate;
    private $weekStart;
    private $days = [];
    private $weekNumbers = [];

    public function __construct($currentDate = null)
    {
        $this->currentDate = $currentDate ? strtotime($currentDate) : time();
        $this->weekStart = strtotime("Monday this week", $this->currentDate);

        $this->generateWeekNumbers();
        $this->generateDaysForWeek($this->weekStart);
    }

    private function generateWeekNumbers()
    {
        for ($i = 0; $i < 4; $i++) {
            $weekStartForNextWeek = strtotime("+$i week", $this->weekStart);
            $this->weekNumbers[] = date('Y-m-d', $weekStartForNextWeek);
        }
    }

    public function generateDaysForWeek($weekStart)
    {
        $this->days = [];
        for ($i = 0; $i < 7; $i++) {
            $this->days[] = date('Y-m-d', strtotime("+$i day", $weekStart));
        }
    }

    public function getWeekNumbers()
    {
        return $this->weekNumbers;
    }

    public function getDays()
    {
        return $this->days;
    }

    public function setWeekByIndex($weekIndex)
    {
        if (isset($this->weekNumbers[$weekIndex])) {
            $this->weekStart = strtotime($this->weekNumbers[$weekIndex]);
            $this->generateDaysForWeek($this->weekStart);
        }
    }
}
