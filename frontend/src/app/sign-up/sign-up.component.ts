import { Component } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css']
})
export class SignUpComponent {
  name: string = '';
  email: string = '';
  password: string = '';
  phoneNumber: string = '';
  role: string = '';

  constructor(private authService: AuthService, private router: Router) {}
  
  onSubmit(){
      this.authService.signUp(this.name, this.email, this.password, this.phoneNumber, this.role)
      .subscribe({
        next: (response)=>{
          alert("Sign up Successfully")
          this.authService.login(this.email, this.password).subscribe({
            next: (response) => {
              this.authService.saveTokens({
                access_token: response.access_token,
                refresh_token: response.refresh_token
              });
              this.router.navigate(['/home']);
            },
            error: (error) => {
              alert('Login failed: '+ error.error?.message);
            }
          })

        },
        error: (error)=>{
          if(error.status == 422) {
            alert("All fields are required")
          }
          if(error?.error?.errors?.email) {
            alert(error.error.errors.email);
          }
          if(error.error?.errors?.password) {
            alert(error.error.errors.password);
          }
          console.log(error.status);
          console.log(error.error);
          
        }
      })
  }
}
