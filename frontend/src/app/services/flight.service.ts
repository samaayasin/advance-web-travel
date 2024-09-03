import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { AuthService } from './auth.service';
import { map } from 'rxjs/operators';

interface Flight {
  FlightID: string;
  UserID: string;
  AirlineName: string;
  DepartureAirport: string;
  ArrivalAirport: string;
  DepartureTime: string;
  ArrivalTime: string;
  Price: number;
  Availability: number;
  image_url: string;
  created_at: string;
  updated_at: string;
}

@Injectable({
  providedIn: 'root'
})
export class FlightService {
  private apiUrl = 'http://localhost:8000/api/search/flights';

  constructor(private http: HttpClient) { }

  searchFlights(filters: any): Observable<any> {
    let params = new HttpParams();
    for (const key in filters) {
      if (filters[key]) {
        params = params.set(key, filters[key]);
      }
    }
    return this.http.get<any>(this.apiUrl, { params });
  }
  getFlightsForUser(userId: string): Observable<Flight[]> {
    return this.searchFlights({})
      .pipe(
        map((flights: Flight[]) => {
          return flights.filter(flight => flight.UserID === userId);
        })
      );
  }
}
