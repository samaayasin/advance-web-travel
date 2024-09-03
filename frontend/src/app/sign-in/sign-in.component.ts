import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { HttpErrorResponse } from '@angular/common/http';

@Component({
  selector: 'app-sign-in',
  templateUrl: './sign-in.component.html',
  styleUrls: ['./sign-in.component.css']
})
export class SignInComponent {
  email: string = '';
  password: string = '';

  constructor(private authService: AuthService, private router: Router) {}

  onSubmit() {
    if (this.email && this.password) {
      this.authService.login(this.email, this.password).subscribe(
        (response) => {
          console.log('Login successful', response);
          alert('Login successful');
          
          this.authService.saveTokens({
            access_token: response.access_token,
            refresh_token: response.refresh_token
          });
          
          this.router.navigate(['/home']);
        },
        (error: HttpErrorResponse) => {
          if(error.status == 401) {
            alert('Incorrect Email or Password');
            return
          }
          alert('Login failed: '+ error.error?.message);
          console.error('Login failed');
          console.error('Error status:', error.status);
          console.error('Error message: ', error.message);
        }
      );
    } else {
      alert('Please enter your email and password');
    }
  }
}
