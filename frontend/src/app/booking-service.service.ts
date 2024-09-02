import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class BookingServiceService {

  private apiUrl = 'http://localhost:8000/api/bookings';

  constructor(private http: HttpClient) {}

  getFlightBookings(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/flight`);
  }

  getCarBookings(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/car`);
  }

  getHotelBookings(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/hotel`);
  }
  getLatestBookings(): Observable<any> {
    return this.http.get<any>("http://localhost:8000/api/latest-bookings");
  }
}
