<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePortfolioContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'array:profile,projects,gallery,stats,skills,achievements,services,contacts,medsos,socialLinks'],
            'content.profile' => ['required', 'array:name,role,headline,bio,avatar,online,studentId,birthInfo,address,gender,nationality,institution,studyProgram,email,phone'],
            'content.profile.name' => ['required', 'string', 'max:100'],
            'content.profile.role' => ['required', 'string', 'max:100'],
            'content.profile.headline' => ['required', 'string', 'max:180'],
            'content.profile.bio' => ['required', 'string', 'max:1000'],
            'content.profile.avatar' => ['required', 'string', 'max:2048', 'regex:/^(https?:\\/\\/|\\/)/i'],
            'content.profile.online' => ['required', 'boolean'],
            'content.profile.studentId' => ['nullable', 'string', 'max:50'],
            'content.profile.birthInfo' => ['nullable', 'string', 'max:150'],
            'content.profile.address' => ['nullable', 'string', 'max:500'],
            'content.profile.gender' => ['nullable', 'string', 'max:40'],
            'content.profile.nationality' => ['nullable', 'string', 'max:80'],
            'content.profile.institution' => ['nullable', 'string', 'max:120'],
            'content.profile.studyProgram' => ['nullable', 'string', 'max:120'],
            'content.profile.email' => ['nullable', 'email', 'max:254'],
            'content.profile.phone' => ['nullable', 'string', 'max:40'],
            'content.projects' => ['required', 'array'],
            'content.projects.*' => ['required', 'array:id,title,description,category,featured,year,image,techs,link'],
            'content.projects.*.id' => ['required', 'string', 'max:100', 'distinct'],
            'content.projects.*.title' => ['required', 'string', 'max:120'],
            'content.projects.*.description' => ['required', 'string', 'max:500'],
            'content.projects.*.category' => ['required', 'string', 'max:80'],
            'content.projects.*.featured' => ['required', 'boolean'],
            'content.projects.*.year' => ['required', 'date_format:Y'],
            'content.projects.*.image' => ['required', 'string', 'max:2048', 'regex:/^(https?:\\/\\/|\\/)/i'],
            'content.projects.*.techs' => ['present', 'array'],
            'content.projects.*.techs.*' => ['required', 'string', 'max:80'],
            'content.projects.*.link' => ['required', 'string', 'max:2048', 'regex:/^(https?:\\/\\/|#|\\/)/i'],
            'content.gallery' => ['required', 'array'],
            'content.gallery.*' => ['required', 'array:id,title,image'],
            'content.gallery.*.id' => ['required', 'string', 'max:100', 'distinct'],
            'content.gallery.*.title' => ['required', 'string', 'max:120'],
            'content.gallery.*.image' => ['required', 'string', 'max:2048', 'regex:/^(https?:\\/\\/|\\/)/i'],
            'content.stats' => ['present', 'array'],
            'content.stats.*' => ['required', 'array:value,label'],
            'content.stats.*.value' => ['required', 'string', 'max:40'],
            'content.stats.*.label' => ['required', 'string', 'max:100'],
            'content.skills' => ['present', 'array'],
            'content.skills.*' => ['required', 'array:name,skills'],
            'content.skills.*.name' => ['required', 'string', 'max:100'],
            'content.skills.*.skills' => ['present', 'array'],
            'content.skills.*.skills.*' => ['required', 'array:name,tag,initial,handle,description,level,since'],
            'content.skills.*.skills.*.name' => ['required', 'string', 'max:80'],
            'content.skills.*.skills.*.tag' => ['required', 'string', 'max:20'],
            'content.skills.*.skills.*.initial' => ['required', 'string', 'max:10'],
            'content.skills.*.skills.*.handle' => ['required', 'string', 'max:80'],
            'content.skills.*.skills.*.description' => ['required', 'string', 'max:500'],
            'content.skills.*.skills.*.level' => ['required', 'string', 'max:40'],
            'content.skills.*.skills.*.since' => ['required', 'string', 'max:20'],
            'content.achievements' => ['present', 'array'],
            'content.achievements.*' => ['required', 'array:title,description,image,badge'],
            'content.achievements.*.title' => ['required', 'string', 'max:120'],
            'content.achievements.*.description' => ['required', 'string', 'max:500'],
            'content.achievements.*.image' => ['required', 'string', 'max:2048', 'regex:/^(https?:\\/\\/|\\/)/i'],
            'content.achievements.*.badge' => ['nullable', 'string', 'max:40'],
            'content.services' => ['present', 'array'],
            'content.services.*' => ['required', 'array:name,description,icon,tags,price'],
            'content.services.*.name' => ['required', 'string', 'max:120'],
            'content.services.*.description' => ['required', 'string', 'max:500'],
            'content.services.*.icon' => ['required', 'string', 'max:20'],
            'content.services.*.tags' => ['present', 'array'],
            'content.services.*.tags.*' => ['required', 'string', 'max:80'],
            'content.services.*.price' => ['required', 'string', 'max:80'],
            'content.contacts' => ['present', 'array'],
            'content.contacts.*' => ['required', 'array:label,href'],
            'content.contacts.*.label' => ['required', 'string', 'max:80'],
            'content.contacts.*.href' => ['required', 'string', 'max:2048', 'regex:/^(https?:\\/\\/|mailto:|tel:)/i'],
            'content.medsos' => ['present', 'array'],
            'content.medsos.*' => ['required', 'array:label,href'],
            'content.medsos.*.label' => ['required', 'string', 'max:80'],
            'content.medsos.*.href' => ['required', 'string', 'max:2048', 'regex:/^(https?:\\/\\/|mailto:|tel:)/i'],
            'content.socialLinks' => ['present', 'array'],
            'content.socialLinks.*' => ['required', 'array:name,href'],
            'content.socialLinks.*.name' => ['required', 'string', 'max:80'],
            'content.socialLinks.*.href' => ['required', 'string', 'max:2048', 'regex:/^(https?:\\/\\/|mailto:|tel:)/i'],
        ];
    }
}
