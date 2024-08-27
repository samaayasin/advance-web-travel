import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';  
import { HttpClientModule } from '@angular/common/http';


import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { TablesComponent } from './tables/tables.component';
import { CardsComponent } from './cards/cards.component';
import { FlightServicesComponent } from './flight-services/flight-services.component';
import { SummaryComponent } from './summary/summary.component';
import { CarServicesComponent } from './car-services/car-services.component';
import { HotelServicesComponent } from './hotel-services/hotel-services.component';
import { UserMangementComponent } from './user-mangement/user-mangement.component';
import { BookingCarViewComponent } from './booking-car-view/booking-car-view.component';
import { BookingFlightViewComponent } from './booking-flight-view/booking-flight-view.component';
import { BookingHotelViewComponent } from './booking-hotel-view/booking-hotel-view.component';
import { AdminCompComponent } from './admin-comp/admin-comp.component';

@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    TablesComponent,
    CardsComponent,
    FlightServicesComponent,
    SummaryComponent,
    CarServicesComponent,
    HotelServicesComponent,
    UserMangementComponent,
    BookingCarViewComponent,
    BookingFlightViewComponent,
    BookingHotelViewComponent,
    AdminCompComponent
    
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
