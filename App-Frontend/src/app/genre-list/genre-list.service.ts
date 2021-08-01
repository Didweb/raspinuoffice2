import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs/Observable";

@Injectable({
  providedIn: 'root'
})
export class GenreListService {
  constructor(private http: HttpClient) {}
  data: any;

  getGenre(): Observable<any> {
    return this.http.get("http://localhost:8080/api/genres/list");
  }
}
