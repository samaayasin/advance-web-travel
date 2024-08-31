import { Component,OnInit} from '@angular/core';
import { BookingServiceService } from '../booking-service.service';

@Component({
  selector: 'app-booking-car-view',
  templateUrl: './booking-car-view.component.html',
  styleUrls: ['./booking-car-view.component.css']
})
export class BookingCarViewComponent implements OnInit{
  carBookings: any[] = [];

  constructor(private BookingServiceService: BookingServiceService) {}

  ngOnInit() {
    this.BookingServiceService.getCarBookings().subscribe(
      data => this.carBookings = data,
      error => console.error('Error fetching car bookings', error)
    );
  }
}
