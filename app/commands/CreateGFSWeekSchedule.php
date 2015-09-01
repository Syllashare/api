<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Syllashare\Component\Schedule\Week\Model\WeekSchedule;
use Syllashare\Component\Date\Year\Model\Year;
use Syllashare\Component\School\Model\School;
use Syllashare\Component\Schedule\Day\Model\DaySchedule;
use Syllashare\Component\Period\Model\Period;

class CreateGFSWeekSchedule extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'schedule:week:create:gfs';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create the GFS WeekSchedule Object.';

	protected $homeroom = array(
		'08:10:00',
		'08:20:00'
	);

	protected $first = array(
		'08:20:00',
		'09:05:00'
	);

	protected $second = array(
		'09:05:00',
		'10:05:00'
	);

	protected $third = array(
		'10:05:00',
		'10:50:00'
	);

	protected $lunch = array(
		'10:50:00', 
		'11:35:00'
	);

	protected $fifth = array(
		'11:35:00',
		'12:20:00'
	);

	protected $sixth = array(
		'12:20:00',
		'13:05:00'
	);

	protected $seventh = array(
		'13:05:00',
		'13:50:00'
	);

	protected $eighth = array(
		'13:50:00',
		'14:35:00'
	);

	protected $ninth = array(
		'14:35:00',
		'15:20:00'
	);

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		// create the year object
		$year = new Year;
		$year->name = '2015-2016';
		$year->school_id = School::first()->id;
		$year->save();

		// create the Week Schedule Object
		$week_schedule = new WeekSchedule;
		$week_schedule->name = 'GFS Regular Week Schedule';
		$week_schedule->description = 'The Typical week';
		$week_schedule->year_id = $year->id;
		$week_schedule->active = true;
		$week_schedule->school_id = $year->school_id;
		$week_schedule->save();

		// create the individual day schedules
		$monday = array(
			'Homeroom' 	=> $this->homeroom,
			'1' 		=> array('08:20:00', '09:00:00'),
			'2'			=> array('09:00:00', '10:00:00'),
			'3' 		=> array('10:00:00', '10:40:00'),
			'Assembly' 	=> array('10:40:00', '10:50:00'),
			'Lunch' 	=> $this->lunch,
			'5'			=> $this->fifth,
			'6'			=> $this->sixth,
			'7'			=> $this->seventh,
			'8'			=> $this->eighth,
			'9'			=> $this->ninth
		);

		$tuesday = array(
			'Homeroom'	=> $this->homeroom,
			'1'			=> $this->first,
			'2'			=> $this->second,
			'3'			=> $this->third,
			'Lunch'		=> $this->lunch,
			'5'			=> array('11:35:00', '12:35:00'),
			'6/7'		=> array('12:35:00', '13:35:00'),
			'8/9'		=> array('13:35:00', '14:35:00'),
			'A'			=> $this->ninth
		);

		$wednesday = array(
			'Homeroom'	=> $this->homeroom,
			'1'			=> $this->first,
			'2'			=> $this->second,
			'Assembly'	=> $this->third,
			'Lunch'		=> $this->lunch,
			'5'			=> $this->fifth,
			'6'			=> $this->sixth,
			'7'			=> $this->seventh,
			'8'			=> $this->eighth,
			'9'			=> $this->ninth
		);

		$thursday = array(
			'Homeroom'	=> $this->homeroom,
			'1'			=> $this->first,
			'2'			=> $this->second,
			'Meeting For Worship'	=> $this->third,
			'Lunch'		=> $this->lunch,
			'5'			=> $this->fifth,
			'6'			=> $this->sixth,
			'7'			=> $this->seventh,
			'8'			=> $this->eighth,
			'9'			=> $this->ninth
		);

		$friday = array(
			'Homeroom'	=> $this->homeroom,
			'1'			=> $this->first,
			'2'			=> $this->second,
			'3'			=> $this->third,
			'Lunch'		=> $this->lunch,
			'5'			=> $this->fifth,
			'6'			=> $this->sixth,
			'7'			=> $this->seventh,
			'8'			=> $this->eighth,
			'9'			=> $this->ninth
		);

		$day1 = new DaySchedule;
		$day1->name = 'Monday';
		$day1->save();

		$day2 = new DaySchedule;
		$day2->name = 'Tuesday';
		$day2->save();

		$day3 = new DaySchedule;
		$day3->name = 'Wednesday';
		$day3->save();

		$day4 = new DaySchedule;
		$day4->name = 'Thursday';
		$day4->save();

		$day5 = new DaySchedule;
		$day5->name = 'Friday';
		$day5->save();

		$week_schedule->daySchedules()->save($day1);
		$week_schedule->daySchedules()->save($day2);
		$week_schedule->daySchedules()->save($day3);
		$week_schedule->daySchedules()->save($day4);
		$week_schedule->daySchedules()->save($day5);
		// now, set the periods for each day
		$days = [ [$monday, $day1], [$tuesday, $day2], [$wednesday, $day3], [$thursday, $day4], [$friday, $day5] ];

		foreach ($days as $array)
		{
			$periods = $array[0];
			$dayschedule = $array[1];
			foreach ($periods as $name => $times)
			{
				$period = new Period;
				$period->name = $name;
				$period->start = $times[0];
				$period->end = $times[1];
				$period->save();

				$dayschedule->periods()->attach($period);
			}
		}

		print "Successfully created Schedule!\n ";

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::OPTIONAL, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
