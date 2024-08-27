import { Component } from '@angular/core';

@Component({
  selector: 'app-booking-car-view',
  templateUrl: './booking-car-view.component.html',
  styleUrls: ['./booking-car-view.component.css']
})
export class BookingCarViewComponent {
  bookings = [
    { 
      CarRentalID: 1,
      UserID: 101,
      CarModel: 'Toyota Camry',
      SeatNumber: 5,
      Location: 'New York',
      PricePerDay: 49.99,
      Availability: true,
      StartDate: new Date('2024-09-01').toISOString().split('T')[0],
      EndDate: new Date('2024-09-10').toISOString().split('T')[0]
    },
    // Add more bookings as needed
  ];
}
