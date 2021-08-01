import { RouterModule, Routes } from '@angular/router';
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component';
import { GenreListComponent } from './genre-list/genre-list.component';

const appRoutes: Routes = [
  { path: '', component: AppComponent},
  { path: 'home', component: HomeComponent},
  { path: 'genre-list', component: GenreListComponent},
];
export const Routing = RouterModule.forRoot(appRoutes);
