import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { AuthService } from './services/auth.service';

@Injectable({
  providedIn: 'root'
})
export class FlightBookingService {

  private apiUrl = 'http://127.0.0.1:8000/api/booking/flights';

  constructor(private http: HttpClient, private authService: AuthService) {} 

  bookFlight(flightBookingDetails: { FlightID: string; Numberofpassengers:number}): Observable<any> {
    const token = this.authService.getAccessToken();
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);  

    return this.http.post(this.apiUrl, flightBookingDetails,{ headers });
  }
}
