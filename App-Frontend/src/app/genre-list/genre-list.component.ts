import { Component, OnInit } from '@angular/core';
import {GenreListService} from "./genre-list.service";

@Component({
  selector: 'app-genre-list',
  templateUrl: './genre-list.component.html',
  styleUrls: ['./genre-list.component.css']
})


export class GenreListComponent implements OnInit {
  genres: any;
  data: any;
  constructor(public  genreListService: GenreListService) {}

  ngOnInit() {
   this.genres = this.genreListService.getGenre();
  }

}
