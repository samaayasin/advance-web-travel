import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class BookService {
  private apiUrl = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient, private authService: AuthService) { }

  getBookingFlights() {
    const token = this.authService.getAccessToken()
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    })
    return this.http.get<any>(this.apiUrl+"/booking/flights", {headers})

  }
  
  getBookingCars() {
    const token = this.authService.getAccessToken()
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    })
    return this.http.get<any>(this.apiUrl+"/booking/cars", {headers})

  }

  getBookingHotels() {
    const token = this.authService.getAccessToken()
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    })
    return this.http.get<any>(this.apiUrl+"/booking/hotels", {headers})

  }


}
