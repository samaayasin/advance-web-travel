import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class AvailableService {

  private apiUrl = 'http://localhost:8000/api/availables';

  constructor(private http: HttpClient) {}

  getCars(): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/car`);
  }

  getHotels(): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/hotel`);
  }

  getFlights(): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/flight`);
  }

  updateAvailable(id: number, data: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/car/${id}`, data);
  }

  deleteAvailable(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/car/${id}`);
  }
  addCar(data: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/car`, data);
  }
  }

