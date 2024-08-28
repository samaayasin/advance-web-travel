import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class HotelService {
  private apiUrl = 'http://localhost:8000/api/search/hotels';  // Replace with your actual backend API URL

  constructor(private http: HttpClient) { }

  searchHotels(filters: any): Observable<any[]> {
    let params = new HttpParams();

    // Append filters to the params if they have values
    if (filters.HotelName) {
      params = params.append('HotelName', filters.HotelName);
    }
    if (filters.PricePerNight) {
      params = params.append('PricePerNight', filters.PricePerNight);
    }
    if (filters.StartDate) {
      params = params.append('StartDate', filters.StartDate);
    }
    if (filters.EndDate) {
      params = params.append('EndDate', filters.EndDate);
    }
    if (filters.city) {
      params = params.append('city', filters.city);
    }

    // Make the HTTP GET request with the params
    return this.http.get<any[]>(this.apiUrl, { params });
  }
}
