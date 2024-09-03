import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CarSearchService {

  private apiUrl = 'http://localhost:8000/api/search/cars'; // Your API endpoint

  constructor(private http: HttpClient) { }

  searchCars(filters: any): Observable<any[]> {
    let params = new HttpParams();
    if (filters.model) {params = params.append('CarModel', filters.model);}
    if (filters.year) {params = params.append('Year', filters.model);}
    if (filters.price) {params = params.append('PricePerDay', filters.model);}
    
    // if (model) params = params.append('CarModel', model);
    // if (year) params = params.append('Year', year);
    // if (price) params = params.append('PricePerDay', price);

    return this.http.get<any[]>(this.apiUrl, { params });
  }
}
