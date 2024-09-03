import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { HotelService } from '../services/hotel.service';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-search-hotel',
  templateUrl: './search-hotel.component.html',
  styleUrls: ['./search-hotel.component.css']
})
export class SearchHotelComponent implements OnInit {
  hotelSearchForm: FormGroup;
  hotels: any[] = [];

  constructor(private authService:AuthService,private router: Router,private fb: FormBuilder, private hotelService: HotelService) {
    this.hotelSearchForm = this.fb.group({
      HotelName: [''],
      PricePerNight: [''],
      StartDate: [''],
      EndDate: [''],
      city: ['']
    });
  }

  ngOnInit(): void { }

  onSearch(): void {
    const filters = this.hotelSearchForm.value;
    this.hotelService.searchHotels(filters).subscribe((data: any) => {
      this.hotels = data;
    });
  }

  onBookNow(hotelId: string) {
    
    this.authService.getIsLoggedIn().subscribe(isLoggedIn => {
      if (isLoggedIn) {
        this.router.navigate(['/hotelbooking'], { queryParams: { hotelId: hotelId } });
      } else {
        this.router.navigate(['/sign-in']);
      }
    });
  }
  
}
