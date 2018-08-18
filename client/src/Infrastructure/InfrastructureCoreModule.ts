import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { NgModule, Type } from '@angular/core';
import { FlexLayoutModule } from '@angular/flex-layout';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { MatToolbarModule } from '@angular/material/toolbar';
import { BrowserAnimationsModule, NoopAnimationsModule } from '@angular/platform-browser/animations';
import { RouterModule } from '@angular/router';

import { INFRASTRUCTURE_COMPONENTS } from './Components';
import { INFRASTRUCTURE_MODALS_COMPONENTS } from './Components/Modals';
import { INFRASTRUCTURE_DIRECTIVES } from './Directives';
import { INFRASTRUCTURE_PIPES } from './Pipes';

const MATERIAL_CORE_MODULES = [
    BrowserAnimationsModule,
    NoopAnimationsModule,
    MatToolbarModule,
    MatIconModule,
    MatButtonModule
];

const INFRASTRUCTURE_EXTERNAL_MODULES = [
    ...MATERIAL_CORE_MODULES,
    FlexLayoutModule
];

export const INFRASTRUCTURE_ENTRY_COMPONENTS: Type<any>[] = [
    ...INFRASTRUCTURE_MODALS_COMPONENTS
];

export const INFRASTRUCTURE_COMPONENTS_DIRECTIVES: Type<any>[] = [
    ...INFRASTRUCTURE_COMPONENTS,
    ...INFRASTRUCTURE_ENTRY_COMPONENTS,
    ...INFRASTRUCTURE_DIRECTIVES
];

@NgModule({
    imports: [
        CommonModule,
        RouterModule,
        HttpClientModule,
        FormsModule,
        ...INFRASTRUCTURE_EXTERNAL_MODULES
    ],
    declarations: [
        ...INFRASTRUCTURE_COMPONENTS_DIRECTIVES,
        ...INFRASTRUCTURE_PIPES
    ],
    entryComponents: [
        ...INFRASTRUCTURE_ENTRY_COMPONENTS
    ],
    exports: [
        CommonModule,
        FormsModule,
        HttpClientModule,
        ReactiveFormsModule,
        ...INFRASTRUCTURE_EXTERNAL_MODULES,
        ...INFRASTRUCTURE_COMPONENTS_DIRECTIVES,
        ...INFRASTRUCTURE_PIPES
    ]
})
export class InfrastructureCoreModule {}
