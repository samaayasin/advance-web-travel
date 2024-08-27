import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class AvailableService {

  private baseUrl = 'http://localhost:8000/api/availables'; 

  constructor(private http: HttpClient) { }

  getAvailableItem(type: string, id: number): Observable<any> {
    const url = `${this.baseUrl}/${type}/${id}`;
    return this.http.get<any>(url);
  }

  getAllFlights(): Observable<any[]> {
    const url = `${this.baseUrl}/flight`;
    return this.http.get<any[]>(url);
  }
  addFlight(flight: any): Observable<any> {
    const url = `${this.baseUrl}/flight`;
    return this.http.post<any>(url, flight);
  }

  // Update an existing flight
  updateFlight(id: number, flight: any): Observable<any> {
    const url = `${this.baseUrl}/flight/${id}`;
    return this.http.put<any>(url, flight);
  }

  // Delete a flight
  deleteFlight(id: number): Observable<any> {
    const url = `${this.baseUrl}/flight/${id}`;
    return this.http.delete<any>(url);
  }
}
