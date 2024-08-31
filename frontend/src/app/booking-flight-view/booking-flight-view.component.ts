import { Component,OnInit } from '@angular/core';
import { BookingServiceService } from '../booking-service.service';

@Component({
  selector: 'app-booking-flight-view',
  templateUrl: './booking-flight-view.component.html',
  styleUrls: ['./booking-flight-view.component.css']
})
export class BookingFlightViewComponent implements OnInit {
  
  flightBookings: any[] = [];

  constructor(private BookingServiceService: BookingServiceService) {}

  ngOnInit() {
    this.BookingServiceService.getFlightBookings().subscribe(
      data => this.flightBookings = data,
      error => console.error('Error fetching flight bookings', error)
    );
  }
}
