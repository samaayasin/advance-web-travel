import { Component } from '@angular/core';
import { CarBookingService } from '../car-booking.service';
import { CarSearchService } from '../car-search.service';
import { AuthService } from '../services/auth.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-car-booking',
  templateUrl: './car-booking.component.html',
  styleUrls: ['./car-booking.component.css']
})
export class CarBookingComponent {

  carlId: string | null = null;
  startDate: string = '';
  endDate: string = '';
  CarModel: string = '';
  Year: number = 0;
  Color: string = '';
  PricePerDay: number = 0;
  totalPrice: number = 0;
  Location:string='';

  constructor(
    private carBookingService: CarBookingService,
    private carService: CarSearchService,
    private authService: AuthService,
    private router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.route.queryParams.subscribe(params => {
      this.carlId = params['carId'];
      if (this.carlId) {
        this.fetchCarDetails(this.carlId);
      }
    });
  }

  fetchCarDetails(carlId: string): void {
    const filters = { CarRentalID: this.carlId };
    this.carService.searchCars(filters).subscribe({
      next: (cars) => {
        if (cars.length > 0) {
          const car = cars[0]; 
          this.CarModel = car.CarModel;
          this.Year = car.Year;
          this.Color = car.Color;
          this.PricePerDay = car.PricePerDay;
        }
      },
      error: (error) => {
        console.error('Error fetching car details:', error);
      }
    });
  }

  calculateTotalPrice(): void {
    if (this.startDate && this.endDate) {
      const start = new Date(this.startDate);
      const end = new Date(this.endDate);
      const timeDiff = end.getTime() - start.getTime();
      const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1; 
      this.totalPrice = this.PricePerDay * daysDiff;
    } else {
      this.totalPrice = 0;
    }
  }

  onBookCar(): void {
    if (this.carlId) {
      const carBookingDetails = {
        CarRentalID: this.carlId,
        Location:this.Location,
        StartDate: this.startDate,
        EndDate: this.endDate,
      };

      this.carBookingService.bookCar(carBookingDetails).subscribe({
        next: (response) => {
          alert('Car booked successfully');
          this.router.navigate(['/profile']);
        },
        error: (error) => {
          console.error('Error booking Car:', error);
          alert('Failed to book Car');
        }
      });
    } else {
      alert('Car ID is missing.');
    }
  }

}
