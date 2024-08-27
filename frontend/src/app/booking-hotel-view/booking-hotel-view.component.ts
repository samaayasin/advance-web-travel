import { Component } from '@angular/core';

@Component({
  selector: 'app-booking-hotel-view',
  templateUrl: './booking-hotel-view.component.html',
  styleUrls: ['./booking-hotel-view.component.css']
})
export class BookingHotelViewComponent {
  bookings = [
    { 
      HotelID: 1,
      UserID: 101,
      HotelName: 'Grand Hotel',
      Location: 'Paris',
      RoomType: 'Suite',
      PricePerNight: 199.99,
      Availability: true,
      StartDate: new Date('2024-09-01').toISOString().split('T')[0],
      EndDate: new Date('2024-09-10').toISOString().split('T')[0]
    },
    // Add more bookings as needed
  ];
}
