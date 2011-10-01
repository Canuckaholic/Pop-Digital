//----------------------------------------|
//--> actionScript by Andre Bouchard   <--|
//-->     abouchard77@hotmail.com      <--|
//-->     jfdionne@streamtheworld.com  <--|
//-->     www.generationflash.com      <--|
//-->         September 18 2006        <--|
//----------------------------------------|
import mx.utils.Delegate;
class com.Equalizer {
	public var className = "Equalizer";
	private var _mc:MovieClip;
	public var limiter:Number;
	private var eqLoop;
	private var speed:Number = 200;
	private var speedEndTransition:Number = 300;
	private var endTransitionLoop;
	private var endTransitionNum:Number = 6;
	public var viewLoading:Boolean = true;
	function Equalizer(mc:MovieClip) {
		_mc = mc;
		limiter = 6;
		//beginLoop();
		_global.equalizerMc = this;
	}
	public function setColor(bgColor) {
		for (var each in _mc) {
			var eqMc:Object = _mc[each];
			for (var each_Eq in eqMc) {
				var colorVar = new Color(eqMc[each_Eq].eqSingleSquarre);
				colorVar.setRGB(bgColor);
			}
		}
		_mc.chargement._visible = viewLoading;
	}
	public function setLimiter(_num) {
		trace("limiter = " + _num);
		limiter = _num;
	}
	public function beginLoop() {
		trace("begin EQ");
		_mc.chargement.stop();
		_mc.chargement._visible = false;
		eqLoop = setInterval(Delegate.create(this, loop), speed);
	}
	public function clearLoop() {
		trace("stop the EQ");
		clearInterval(eqLoop);
		endTransitionLoop = setInterval(Delegate.create(this, endTransition), speedEndTransition);
	}
	public function loop() {
		setEq();
	}
	public function setEq() {
		for (var each in _mc) {
			var num = Math.round(Math.random()*limiter);
			//trace(num);
			var eqMc:Object = _mc[each];
			for (var i = 0; i<6; i++) {
				if (i<=num) {
					//trace(eqMc.eq1);
					eqMc["eq"+(i+1)].gotoAndStop(2);
				} else {
					eqMc["eq"+(i+1)].gotoAndStop(1);
				}
			}
		}
	}
	public function endTransition() {
		for (var each in _mc) {
			var eqMc:Object = _mc[each];
			eqMc["eq"+(endTransitionNum)].gotoAndStop(1);
		}
		endTransitionNum--;
		if (endTransitionNum<=1) {
			clearInterval(endTransitionLoop);
			endTransitionNum = 6;
		}
		//trace(endTransitionNum);
	}
	public function clearEq() {
		//trace("eq was cleared");
		for (var each in _mc) {
			var eqMc:Object = _mc[each];
			for (var i = 0; i<5; i++) {
				eqMc["eq"+(i+2)].gotoAndStop(1);
			}
		}
	}
}
