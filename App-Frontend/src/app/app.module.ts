import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';


import { AppComponent } from './app.component';
import { MainMenuComponent } from './main-menu/main-menu.component';
import { GenreListService } from './genre-list/genre-list.service';
import { GenreListComponent } from './genre-list/genre-list.component';
import { HomeComponent } from './home/home.component';
import { Routing } from './app.routing';
import {RouterModule} from "@angular/router";



@NgModule({
  declarations: [
    AppComponent,
    MainMenuComponent,
    GenreListComponent,
    HomeComponent
  ],
  imports: [
    BrowserModule,
    Routing,
    HttpClientModule
  ],
  providers: [GenreListService],
  bootstrap: [AppComponent],
  exports: [RouterModule]
})
export class AppModule { }
