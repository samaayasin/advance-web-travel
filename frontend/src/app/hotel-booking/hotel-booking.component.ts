import { Component } from '@angular/core';
import { HotelBookingService } from '../hotel-booking.service';
import { ActivatedRoute, Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { ProfileComponent } from '../profile/profile.component';
import { ProfileService } from '../services/profile.service';
import { HotelService } from '../services/hotel.service';

@Component({
  selector: 'app-hotel-booking',
  templateUrl: './hotel-booking.component.html',
  styleUrls: ['./hotel-booking.component.css']
})
export class HotelBookingComponent {

  hotelId: string ='';
  startDate: string = '';
  endDate: string = '';
  hotelName: string = '';
  rating: number = 0;
  city: string = '';
  pricePerNight: number = 0;
  totalPrice: number = 0;
  img: any = 0;

  constructor(
    private hotelBookingService: HotelBookingService,
    private hotelService: HotelService,
    private authService: AuthService,
    private router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.route.queryParams.subscribe(params => {
      this.hotelId = params['hotelId'];
      if (this.hotelId) {
        this.fetchHotelDetails(this.hotelId);
      }
    });
  }

  fetchHotelDetails(hotelId: string): void {
    const filters = { HotelID: hotelId };
    this.hotelService.searchHotels(filters).subscribe({
      next: (hotels) => {
        if (hotels.length > 0) {
          const hotelIdNumber = Number(this.hotelId) - 1;
          const hotel = hotels[hotelIdNumber]; 
          this.hotelName = hotel.HotelName;
          this.rating = hotel.rating;
          this.city = hotel.city;
          this.pricePerNight = hotel.PricePerNight;
          this.img=hotel.image_url;
        }
      },
      error: (error) => {
        console.error('Error fetching hotel details:', error);
      }
    });
  }

  calculateTotalPrice(): void {
    if (this.startDate && this.endDate) {
      const start = new Date(this.startDate);
      const end = new Date(this.endDate);
      const timeDiff = end.getTime() - start.getTime();
      const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1; 
      this.totalPrice = this.pricePerNight * daysDiff;
    } else {
      this.totalPrice = 0;
    }
  }

  onBookHotel(): void {
    if (this.hotelId) {
      const hotelBookingDetails = {
        HotelID: this.hotelId,
        StartDate: this.startDate,
        EndDate: this.endDate,
      };

      this.hotelBookingService.bookHotel(hotelBookingDetails).subscribe({
        next: (response) => {
          alert('Hotel booked successfully');
          this.router.navigate(['/profile']);
        },
        error: (error) => {
          console.error('Error booking hotel:', error);
          alert('Failed to book hotel');
        }
      });
    } else {
      alert('Hotel ID is missing.');
    }
  }
}
