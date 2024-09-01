import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private apiUrl = 'http://127.0.0.1:8000/api';
  private isLoggedIn = new BehaviorSubject<boolean>(this.hasToken());

  constructor(private http: HttpClient) { }

  login(email: string, password: string): Observable<any> {

    return this.http.post<any>(this.apiUrl+"/login", { email, password });
  }

  signUp(name: string, email: string, password: string, phoneNumber: string, role: string): Observable<any> {
    const body = {
      name: name,
      email: email,
      password: password,
      phoneNumber: phoneNumber,
      role: role
    };
    
    return this.http.post(`${this.apiUrl}/register`, body);
  }

  logout(): void {
    localStorage.removeItem('access_token');
    this.isLoggedIn.next(false);
  }

  saveTokens(tokens: { access_token: string, refresh_token?: string }): void {
    localStorage.setItem('access_token', tokens.access_token);
    if (tokens.refresh_token) {
      localStorage.setItem('refresh_token', tokens.refresh_token);
    }
    this.isLoggedIn.next(true);
  }

  clearTokens(): void {
    localStorage.removeItem('access_token');
    localStorage.removeItem('refresh_token');
  }

  getAccessToken(): string | null {
    return localStorage.getItem('access_token');
  }

  getRefreshToken(): string | null {
    return localStorage.getItem('refresh_token');
  }

  getIsLoggedIn(): Observable<boolean> {
    return this.isLoggedIn.asObservable();
  }

  private hasToken(): boolean {
    return !!localStorage.getItem('access_token');
  }
}
