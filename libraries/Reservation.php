<?php

class Reservation
{
  private $reservation;
  
  public function __construct($reservationData)
  {
    $this->reservation = $reservationData;  
  }
  
  public function calculateCost()
  {
    $prize = $this->reservation['Price'];
    $totalNights = $this->calculateTotalNights();
    
    $totalCost = $prize * $nights;

    return $totalCost;
  }
  
  public function calculateTotalNights()
  {
    $startDate = strtotime($this->reservation['startDate']);
    $endDate = strtotime($this->reservation['endDate']);
    $totalNights = ($endDate - $startDate) / (60 * 60 * 24);
    
    return $totalNights;
  }
}
