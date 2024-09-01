import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { SearchCarComponent } from './search-car/search-car.component';
import { SearchFlightComponent } from './search-flight/search-flight.component';
import { SearchHotelComponent } from './search-hotel/search-hotel.component';
import { SignInComponent } from './sign-in/sign-in.component';
import { SignUpComponent  } from './sign-up/sign-up.component';
import { ProfileComponent } from './profile/profile.component';
const routes: Routes = [

  {path:'car', component:SearchCarComponent},
  {path:'hotel', component:SearchFlightComponent},
  {path:'flight', component:SearchHotelComponent},
  {path:'home', component:SearchCarComponent},
  {path:'sign-in', component:SignInComponent},
  {path:'sign-up', component:SignUpComponent},
  {path:'profile', component:ProfileComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
