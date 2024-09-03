import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { CarSearchService } from '../car-search.service';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-search-car',
  templateUrl: './search-car.component.html',
  styleUrls: ['./search-car.component.css']
})
export class SearchCarComponent implements OnInit {
  carSearchForm!: FormGroup;
  cars: any[] = [];

  constructor(
    private authService:AuthService,
    private router: Router,
    private fb: FormBuilder,
    private carSearchService: CarSearchService
  ) { }

  ngOnInit(): void {
    this.carSearchForm = this.fb.group({
      model: [''],
      year: [''],
      price: ['']
    });
  }

  onSearch(): void {
    const { model, year, price } = this.carSearchForm.value;
    const filters = this.carSearchForm.value;

    this.carSearchService.searchCars(filters).subscribe(
      (response) => {
        this.cars = response; // Assuming the API response is an array of cars
      },
      (error) => {
        console.error('Error fetching car data', error);
      }
    );
  }

  onBookNow(carId: string) {
    this.authService.getIsLoggedIn().subscribe(isLoggedIn => {
      if (isLoggedIn) {
        this.router.navigate(['/carbooking'], { queryParams: { carId: carId } });
      } else {
        this.router.navigate(['/sign-in']);
      }
    });
  }

}
