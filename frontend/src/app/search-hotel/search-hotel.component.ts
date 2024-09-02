import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { HotelService } from '../services/hotel.service';

@Component({
  selector: 'app-search-hotel',
  templateUrl: './search-hotel.component.html',
  styleUrls: ['./search-hotel.component.css']
})
export class SearchHotelComponent implements OnInit {
  hotelSearchForm: FormGroup;
  hotels: any[] = [];

  constructor(private fb: FormBuilder, private hotelService: HotelService) {
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
}
