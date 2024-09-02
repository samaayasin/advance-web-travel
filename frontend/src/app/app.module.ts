// app.module.ts
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';  
import { HttpClientModule } from '@angular/common/http';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatIconModule } from '@angular/material/icon';
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
import { BookingHotelComponent} from './booking-hotel-view/booking-hotel-view.component';
import { AdminCompComponent } from './admin-comp/admin-comp.component';
import { BookingTablesComponent } from './booking-tables/booking-tables.component';
import { ManageAllServicesComponent } from './manage-all-services/manage-all-services.component';
import { TotalBookingsComponent } from './total-bookings/total-bookings.component';
import { LatestHotelBookingsComponent } from './latest-hotel-bookings/latest-hotel-bookings.component';
import { SummaryServiceComponent } from './summary-service/summary-service.component';
import { ReactiveFormsModule } from '@angular/forms';
import { SearchCarComponent } from './search-car/search-car.component';
import { NavbarComponent } from './navbar/navbar.component';
import { AppRoutingModule } from './app-routing.module';
import { SearchFlightComponent } from './search-flight/search-flight.component';
import { SearchHotelComponent } from './search-hotel/search-hotel.component';
import { SignInComponent } from './sign-in/sign-in.component';
import { SignUpComponent } from './sign-up/sign-up.component';
import { ProfileComponent } from './profile/profile.component';  // Import the AppRoutingModule


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
    BookingHotelComponent,
    AdminCompComponent,
    BookingTablesComponent,
    ManageAllServicesComponent,
    TotalBookingsComponent,
    LatestHotelBookingsComponent,
    SummaryServiceComponent,
    SearchCarComponent,
    NavbarComponent,
    SearchFlightComponent,
    SearchHotelComponent,
    SignInComponent,
    SignUpComponent,
    ProfileComponent,
    
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
    MatToolbarModule,
    MatIconModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
