import { Component, ViewEncapsulation } from '@angular/core';

import { BaseComponent } from '../../Infrastructure';

@Component({
    selector: 'app',
    templateUrl: 'Template/Infrastructure/AppComponent.html',
    styleUrls: ['Styles/Infrastructure/AppComponent.scss']
})
export class AppComponent extends BaseComponent { }
