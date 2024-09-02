import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class RateService {
  private apiUrl = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient, private authService: AuthService) { }

  rateBookingService(bookingType: string, bookingId: any,rating: number, reviewText: string) {
    const token = this.authService.getAccessToken()
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
  })
  const body = {
    rating: rating,
    review_text: reviewText
  };

  return this.http.post<any>(`${this.apiUrl}/${bookingType}/${bookingId}/reviews`, body, { headers });
  }
}
