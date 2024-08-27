import { Component } from '@angular/core';

@Component({
  selector: 'app-flight-services',
  templateUrl: './flight-services.component.html',
  styleUrls: ['./flight-services.component.css']
})
export class FlightServicesComponent {
  flights = [
    { AirlineName: 'Delta', DepartureAirport: 'JFK', ArrivalAirport: 'LAX', DepartureTime: '2023-12-01T08:00', ArrivalTime: '2023-12-01T12:00', Price: 300.00, Availability: true, isEditable: false },
    // Add more flights here
  ];

  // Add a new flight
  addFlight() {
    this.flights.push({ 
      AirlineName: 'New Airline', 
      DepartureAirport: 'New Departure Airport', 
      ArrivalAirport: 'New Arrival Airport', 
      DepartureTime: '2024-01-01T00:00', 
      ArrivalTime: '2024-01-01T01:00', 
      Price: 0.00, 
      Availability: true, 
      isEditable: true 
    });
  }

  // Edit flight (allows editing inputs)
  editFlight(index: number) {
    this.flights[index].isEditable = true;
  }

  // Save flight (disables editing and saves changes)
  saveFlight(index: number) {
    this.flights[index].isEditable = false;
  }

  // Delete flight
  deleteFlight(index: number) {
    this.flights.splice(index, 1);
  }
}
