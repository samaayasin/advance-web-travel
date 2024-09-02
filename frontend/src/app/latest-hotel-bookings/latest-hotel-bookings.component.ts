import { Component } from '@angular/core';
import { BookingServiceService } from '../booking-service.service'; 
@Component({
  selector: 'app-latest-hotel-bookings',
  templateUrl: './latest-hotel-bookings.component.html',
  styleUrls: ['./latest-hotel-bookings.component.css']
})
export class LatestHotelBookingsComponent {
  bookings: any[] = [];

  constructor(private BookingServiceService: BookingServiceService) { }

  ngOnInit(): void {
    this.BookingServiceService.getLatestBookings().subscribe((data) => {
      this.bookings = data.map((booking: any) => ({
        imageUrl: "../assets/H2.jpeg",  
        hotelName: booking.HotelName,
        dateRange: `${booking.StartDate} - ${booking.EndDate}`,
        customerName: booking.UserID,  
        daysAgo: this.calculateDaysAgo(booking.created_at)
      }));
    });
  }

  calculateDaysAgo(date: string): string {
    const createdAt = new Date(date);
    const now = new Date();
    const diffInTime = now.getTime() - createdAt.getTime();
    const diffInDays = Math.floor(diffInTime / (1000 * 3600 * 24));
    return `${diffInDays} days ago`;
  }
}
