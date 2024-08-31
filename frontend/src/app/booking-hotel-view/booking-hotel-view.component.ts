import { Component, OnInit } from '@angular/core';
import { BookingServiceService } from '../booking-service.service';

@Component({
  selector: 'app-booking-hotel-view',
  templateUrl: './booking-hotel-view.component.html',
  styleUrls: ['./booking-hotel-view.component.css']
})
export class BookingHotelComponent implements OnInit {
  hotelBookings: any[] = [];

  constructor(private BookingServiceService: BookingServiceService) {}

  ngOnInit() {
    this.BookingServiceService.getHotelBookings().subscribe(
      
      data => {
        console.log(data); // Log to inspect the data structure
        this.hotelBookings = data;
      },
      error => console.error('Error fetching hotel bookings', error)
    );
  }
}
