import { Input, OnChanges, OnInit, SimpleChanges } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';

import { CommonConstants } from '../../Constants/CommonConstants';
import { BasicSwitchValue, SwitchValue } from '../../Models/ContextSwitch/SwitchValue';

export abstract class SwitchSelectorBase implements OnInit, OnChanges {
    @Input() context = CommonConstants.READONLY_SWITCH_CONTEXT;

    protected abstract calculateSwitchValue(): Observable<BasicSwitchValue>;
    protected abstract get inputValue(): BasicSwitchValue;
    protected valuePropagator: BehaviorSubject<BasicSwitchValue>;

    constructor(protected switchValue: SwitchValue) {}

    public ngOnChanges(changes: SimpleChanges): void {
        this.propagateValue();
    }

    private propagateValue(): void {
        if (this.valuePropagator) {
            this.valuePropagator.next(this.inputValue);
        }
    }

    public ngOnInit(): void {
        this.valuePropagator = new BehaviorSubject<BasicSwitchValue>(this.inputValue);
        this.switchValue.context = this.context;
        this.switchValue.value = this.calculateSwitchValue();
    }
}
