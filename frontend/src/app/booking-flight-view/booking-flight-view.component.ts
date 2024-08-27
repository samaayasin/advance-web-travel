import { Component } from '@angular/core';

@Component({
  selector: 'app-booking-flight-view',
  templateUrl: './booking-flight-view.component.html',
  styleUrls: ['./booking-flight-view.component.css']
})
export class BookingFlightViewComponent {
  bookings = [
    { 
      FlightID: 1,
      UserID: 101,
      AirlineName: 'Delta Airlines',
      DepartureAirport: 'JFK',
      ArrivalAirport: 'LAX',
      DepartureTime: new Date('2024-09-01T08:00:00').toISOString(),
      ArrivalTime: new Date('2024-09-01T11:00:00').toISOString(),
      Price: 299.99,
      Availability: true,
      StartDate: new Date('2024-09-01').toISOString().split('T')[0],
      EndDate: new Date('2024-09-10').toISOString().split('T')[0]
    },
    // Add more bookings as needed
  ];
}
