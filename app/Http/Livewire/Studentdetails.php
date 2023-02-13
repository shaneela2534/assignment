<?php

namespace App\Http\Livewire;
use App\Models\Student;
use App\Models\Course;
use Livewire\Component;

class Studentdetails extends Component
{
    public function render()
    {
        $this->students = Student::with('courses')->get();
        return view('livewire.studentdetails');
    }
    public $students, $name, $dob, $note, $student_id, $courses = [];
    public $isModalOpen = 0;
    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
    private function resetCreateForm(){
        $this->name = '';
        $this->dob = '';
        $this->note = '';
        $this->courses = [];
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'dob' => 'required',
            'note' => 'required',
            'course_id'=>'required',
        ]);

        Student::updateOrCreate(['id' => $this->student_id], [
            'name' => $this->name,
            'dob' => $this->dob,
            'note' => $this->note,
        ]);
        $student->courses()->sync($this->courses);
        session()->flash('message', $this->student_id ? 'Student updated.' : 'Student created.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->student_id = $id;
        $this->name = $student->name;
        $this->dob = $student->dob;
        $this->note = $student->note;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Student::find($id)->delete();
        session()->flash('message', 'Student deleted.');
    }
}
