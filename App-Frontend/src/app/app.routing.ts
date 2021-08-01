import { RouterModule, Routes } from '@angular/router';
import { AppComponent } from './app.component';
import { GenreListComponent } from './genre-list/genre-list.component';

const appRoutes = [
  { path: 'genre-list', component: GenreListComponent,  pathMatch: 'full'},
];
export const Routing = RouterModule.forRoot(appRoutes);
