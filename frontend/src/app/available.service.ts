import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class AvailableService {

  private apiUrl = 'http://localhost:8000/api/availables';

  constructor(private http: HttpClient) {}

  getItems(type: string): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/${type}`);
  }

  updateItem(type: string, id: number, data: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/${type}/${id}`, data);
  }

  deleteItem(type: string, id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/${type}/${id}`);
  }

  addItem(type: string, data: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/${type}`, data);
  }

  }

