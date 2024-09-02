import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { SearchCarComponent } from './search-car/search-car.component';
import { SearchFlightComponent } from './search-flight/search-flight.component';
import { SearchHotelComponent } from './search-hotel/search-hotel.component';
import { HomeComponent } from './home/home.component';

const routes: Routes = [

  {path:'car', component:SearchCarComponent},
  {path:'hotel', component:SearchFlightComponent},
  {path:'flight', component:SearchHotelComponent},
  {path:'home', component:HomeComponent},
  { path: 'search-flight', component: SearchFlightComponent },
  { path: 'search-car', component: SearchCarComponent },
  { path: 'search-hotel', component: SearchHotelComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
