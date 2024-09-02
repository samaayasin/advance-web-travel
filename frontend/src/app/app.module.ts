// app.module.ts
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatIconModule } from '@angular/material/icon';
import { HttpClientModule } from '@angular/common/http';


import { ReactiveFormsModule } from '@angular/forms';
import { AppComponent } from './app.component';
import { SearchCarComponent } from './search-car/search-car.component';
import { FormsModule } from '@angular/forms';

import { NavbarComponent } from './navbar/navbar.component';
import { AppRoutingModule } from './app-routing.module';

import { SearchFlightComponent } from './search-flight/search-flight.component';
import { SearchHotelComponent } from './search-hotel/search-hotel.component';
import { SignInComponent } from './sign-in/sign-in.component';
import { SignUpComponent } from './sign-up/sign-up.component';
import { ProfileComponent } from './profile/profile.component';
import { ReviewModalComponent } from './review-modal/review-modal.component';


@NgModule({
  declarations: [
    AppComponent,
    SearchCarComponent,
    NavbarComponent,
    SearchFlightComponent,
    SearchHotelComponent,
    SignInComponent,
    SignUpComponent,
    ProfileComponent,
    ReviewModalComponent,
    
    
  ],
  imports: [
    BrowserModule,
    ReactiveFormsModule,
    MatToolbarModule,
    MatIconModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
